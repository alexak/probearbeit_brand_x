<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EmployeeRepository;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiEmployeeController extends AbstractController
{
    private EmployeeRepository $employeeRepository;
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(
        EmployeeRepository $employeeRepository,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    )
    {
        $this->employeeRepository = $employeeRepository;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }


    #[Route('/api/employee', name: 'app_api_employee_get_all', methods: ['GET'])]
    public function getEmployees(): JsonResponse
    {
        $employees = $this->employeeRepository->get();
        $data = $this->serializer->serialize($employees, 'json', ['groups' => 'employee:read']);

        return JsonResponse::fromJsonString($data);
    }


    #[Route('/api/employee/{id}', name: 'app_api_employee_get_unique', methods: ['GET'])]
    public function getEmployee(int $id): JsonResponse
    {
        $employee = $this->employeeRepository->getById($id);
        if (!$employee) {
            throw new NotFoundHttpException('Employee not found');
        }

        $data = $this->serializer->serialize($employee, 'json', ['groups' => 'employee:read']);

        return JsonResponse::fromJsonString($data);
    }


    #[Route('/api/employee', name: 'app_api_employee_post', methods: ['POST'])]
    public function postEmployee(Request $request, SluggerInterface $slugger): Response
    {
        /** @var UploadedFile $file */  
        $file = $request->files->get('file');

        if (!$file) {
            return new JsonResponse(['status' => 'No file uploaded'], Response::HTTP_BAD_REQUEST);
        }
       
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.csv';
       
        // Move the file to a temporary location
        try {
            $file->move(
                $this->getParameter('kernel.project_dir') . '/var/tmp', 
                $newFilename
            );
        } catch (FileException $e) {
            return new JsonResponse(
                [
                    'status' => 'File upload error', 
                    'message' => $e->getMessage()
                ], Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
       
        // Process the CSV file
        $filePath = $this->getParameter('kernel.project_dir') . '/var/tmp/' . $newFilename;
        $handle = fopen($filePath, 'r');
        if ($handle === false) {
            return new JsonResponse([
                'status' => 'Unable to open file'
                ], Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
       
        $header = null;
        $classMetadata = $this->entityManager->getClassMetadata(Employee::class);
        $fieldMappings = $classMetadata->fieldMappings;
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            if (!$header) {
                $header = $row;
            } else {
                $employeeData = array_combine($header, $row);
                $employee = new Employee();
                foreach ($employeeData as $attribute => $value) {
                    $mappedAttribute = $this->getAttributeMapping($attribute);
                    if (isset($fieldMappings[$mappedAttribute])) {
                        $type = $fieldMappings[$mappedAttribute]['type'];
                        $employee->setAttribute($mappedAttribute, $value, $type);
                    }
                }
                $this->employeeRepository->save($employee, true);
            }
        }
       
        fclose($handle);

        // Remove the file after processing
        unlink($filePath);
       
        // Handle POST request
        return new Response('Data imported');
    }


    #[Route('/api/employee/{id}', name: 'app_api_employee_delete', methods: ['DELETE'])]
    public function deleteEmployee(int $id): Response
    {
        // Handle DELETE request
        $employee = $this->employeeRepository->getById($id);
        if (!$employee) {
            throw new NotFoundHttpException('Employee not found');
        }
        $this->employeeRepository->remove($employee, true);

        return new Response('employee deleted');
    }


    /**
     * Function that returns  correcrt mapping between csv fields and entity attribute
     *
     * @param string $attribute
     * @return string
     */
    private function getAttributeMapping(string $attribute): string {
        $mapping = [
            'Emp ID'=>'employeeId',
            'Name Prefix'=>'namePrefix',
            'First Name'=>'firstName',
            'Middle Initial'=>'middleInitial',
            'Last Name'=>'lastName',
            'Gender'=>'gender',
            'E Mail'=>'email',
            'Date of Birth'=>'dateOfBirth',
            'Time of Birth'=>'timeOfBirth',
            'Age in Yrs.'=>'ageInYrs',
            'Date of Joining'=>'dateOfJoining',
            'Age in Company (Years)'=>'ageInCompany',
            'Phone No. '=>'phoneNo',
            'Place Name'=>'placeName',
            'County'=>'county',
            'City'=>'city',
            'Zip'=>'zip',
            'Region'=>'region',
            'User Name'=>'userName',
        ];

        return $mapping[$attribute];
    }
}

