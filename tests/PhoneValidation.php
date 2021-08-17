<?php


namespace App\Tests;
use App\Constant\Country;
use App\Entity\Customer;
use App\Service\PhoneDataService;
use App\Service\ValidationService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhoneValidation extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @test
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @test
     */
    public function testIndex()
    {
        self::ensureKernelShutdown();
        $client = self::createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function testCountriesDataIsArray()
    {
        $countries = Country::getCountriesData();
        $this->assertIsArray($countries);
    }

    /**
     * @test
     */
    public function testCountriesDataContainRegexPattern()
    {
        $countries = Country::getCountriesData();
        $this->assertArrayHasKey('regex', $countries['Uganda']);
    }

    /**
     * @test
     */
    public function testCountriesDataContainCountryCode()
    {
        $countries = Country::getCountriesData();
        $this->assertArrayHasKey('countryCode', $countries['Mozambique']);
    }

    /**
     * @test
     */
    public function testPhonesDataReturnArray()
    {
        $customer = $this->em->getRepository(Customer::class)->findOneBy(['id' => 1]);
        $countriesData = Country::getCountriesData();

        $validationService = new ValidationService(new PhoneDataService($countriesData));

        $phonesData =  $validationService->validate(array(['phone' => $customer->getPhone()]));

        $this->assertIsArray($phonesData);
    }

    /**
     * @test
     */
    public function testCustomerContainPhoneNumber()
    {
        $this->assertClassHasAttribute('phone', Customer::class);
    }

    /**
     * @test
     */
    public function testCustomerHasPhoneNumber()
    {
        $customer = new Customer();
        $customer->setPhone('(212) 691933336');

        $this->assertSame('(212) 691933336', $customer->getPhone());
    }

    /**
     * @test
     */
    public function testPhoneNumberContainCountryCode()
    {
        $countryCode = "212";
        $customer = new Customer();
        $customer->setPhone('(212) 691933336');
        $phoneCountryCode = substr($customer->getPhone() , 1, 3);

        $this->assertSame($countryCode, $phoneCountryCode);
    }

    /**
     * @test
     */
    public function testPhonesDataContainCountryCode()
    {
        $customer = $this->em->getRepository(Customer::class)->findOneBy(['id' => 1]);
        $countriesData = Country::getCountriesData();

        $validationService = new ValidationService(new PhoneDataService($countriesData));
        $phonesData =  $validationService->validate(array(['phone' => $customer->getPhone()]));

        $this->assertArrayHasKey('countryCode', $phonesData[0]);
    }

    /**
     * @test
     */
    public function testPhonesDataContainCountryName()
    {
        $customer = $this->em->getRepository(Customer::class)->findOneBy(['id' => 1]);
        $countriesData = Country::getCountriesData();

        $validationService = new ValidationService(new PhoneDataService($countriesData));
        $phonesData =  $validationService->validate(array(['phone' => $customer->getPhone()]));

        $this->assertArrayHasKey('countryName', $phonesData[0]);
    }

    /**
     * @test
     */
    public function testPhonesDataContainState()
    {
        $customer = $this->em->getRepository(Customer::class)->findOneBy(['id' => 1]);
        $countriesData = Country::getCountriesData();

        $validationService = new ValidationService(new PhoneDataService($countriesData));
        $phonesData =  $validationService->validate(array(['phone' => $customer->getPhone()]));

        $this->assertArrayHasKey('state', $phonesData[0]);
    }

    /**
     * @test
     */
    public function testPhonesDataContainPhoneNumber()
    {
        $customer = $this->em->getRepository(Customer::class)->findOneBy(['id' => 1]);
        $countriesData = Country::getCountriesData();

        $validationService = new ValidationService(new PhoneDataService($countriesData));

        $phonesData =  $validationService->validate(array(['phone' => $customer->getPhone()]));

        $this->assertArrayHasKey('phoneNumber', $phonesData[0]);
    }

    /**
     * @test
     */
    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
