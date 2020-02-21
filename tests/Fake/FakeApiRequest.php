<?php


namespace Hell\Vephar\Fake;


use Faker\Factory;

class FakeApiRequest
{
    public static function getAll()
    {
        $faker = Factory::create();
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                "name" => $faker->name,
                "lastName" => $faker->lastName,
                "Address" => $faker->address,
                "another_Array" => [
                    "company_name" => $faker->company,
                    "EMAIL" => $faker->email
                ],
                "true_array"=>[
                    123,
                    10,
                    15
                ]
            ];
        }

        return $data;
    }

    public static function getOne()
    {
        $data = self::getAll();
        return $data[0];
    }
}
