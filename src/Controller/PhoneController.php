<?php

namespace App\Controller;

use App\Constant\Country;
use App\Entity\Customer;
use App\Service\PhoneFilter;
use App\Service\PhoneDataService;
use App\Service\ValidationService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class PhoneController extends AbstractController
{
    /*
     * @var
     */
    const LIMIT = 10;
    /*
     * @var
     */
    const PAGE = 1;

    /**
     * @Route("/", name="home_page")
     *
     * @param Request $request
     * @param PaginatorInterface $paginator
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $customerRepo= $this->getDoctrine()->getRepository(Customer::class);
        $customersPhones = $customerRepo->getCustomersPhones()->getResult();
        $countriesData= Country::getCountriesData();

        $validationService = new ValidationService(new PhoneDataService($countriesData));
        $phonesData =  $validationService->validate($customersPhones);
        $filters = $request->query->all();

        if (count($filters) > 0 ) {
            unset($filters['limit']);
            unset($filters['page']);
            $phonesFilter = new PhoneFilter();
            $phonesData = $phonesFilter->applyFilter($phonesData, $filters);
        }

        $phonesData = $paginator->paginate(
            $phonesData,
            $request->query->get('page', self::PAGE),
            $request->query->get('limit', self::LIMIT)
        );

        return $this->render('index.html.twig', [
            'phonesData' => $phonesData,
            'countriesNamesWithCodes' => Country::getCountriesNamesWithCodes()
        ]);
    }
}
