<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governorates = [
            ["name" => " Aswan"        ],
            ["name" => "Asyut"         ],
            ["name" => "Beheira"       ],
            ["name" => " Beni Suef"    ],
            ["name" => "Cairo"         ],
            ["name" => "Dakahlia"      ],
            ["name" => "Damietta"      ],
            ["name" => "Faiyum"        ],
            ["name" => " Gharbia"      ],
            ["name" => "Giza"          ],
            ["name" => "Ismailia"      ],
            ["name" => "Kafr El Sheikh"],
            ["name" => "Luxor"         ],
            ["name" => "Matruh"        ],
            ["name" => "Minya"         ],
            ["name" => "Monufia"       ],
            ["name" => "New Valley"    ],
            ["name" => "North Sinai"   ],
            ["name" => "Port Said"     ],
            ["name" => "Qalyubia"      ],
            ["name" => "Qena"          ],
            ["name" => "Red Sea"       ],
            ["name" => "Sharqia"       ],
            ["name" => "Sohag"         ],
            ["name" => "South Sinai"   ],
            ["name" => "Suez"          ],
        ];

        foreach ($governorates as $governorate) {
            Governorate::create($governorate);
        }
    }
}
