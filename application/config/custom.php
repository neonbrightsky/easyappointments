<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|------------------------------------------------------------------
| Master list of preset fields (Croatian labels, mandatory = true)
| Applies to ALL services on both public + backend views.
|------------------------------------------------------------------
*/
$config['ea_preset_fields'] = [
    ['label' => 'Ime',                         'mandatory' => true],
    ['label' => 'Prezime',                     'mandatory' => true],
    ['label' => 'Članski broj',                'mandatory' => true],
    ['label' => 'Klub',                        'mandatory' => true],
    ['label' => 'Tip članarine',               'mandatory' => true],
    ['label' => 'Datum isteka članarine',      'mandatory' => true],
    ['label' => 'Broj mobitela',               'mandatory' => true],
    ['label' => 'Marka i model vozila',        'mandatory' => true],
    ['label' => 'Registracija',                'mandatory' => true],
];

/*
|------------------------------------------------------------------
| Service-specific extra fields (shown + mandatory)
| A: “Zamjena guma” → + Veličina kotača
|    “Dijagnostika” → no extras
|    “Klima”        → + godina proizvodnje
|    “Popravci”     → + Broj Šasije (E), Zapremnina motora (cm3, P1),
|                      Snaga motora (kW, P.2), Tip i model motora (14.),
|                      Godina proizvodnje (B)
|------------------------------------------------------------------
*/
$config['ea_service_extras'] = [
    'Zamjena guma' => [
        ['label' => 'Veličina kotača', 'mandatory' => true],
    ],
    'Dijagnostika' => [
        // no extras
    ],
    'Klima' => [
        ['label' => 'godina proizvodnje', 'mandatory' => true],
    ],
    'Popravci' => [
        ['label' => 'Broj šasije (E)',                 'mandatory' => true],
        ['label' => 'Zapremnina motora (cm3, P1)',     'mandatory' => true],
        ['label' => 'Snaga motora (kW, P.2)',          'mandatory' => true],
        ['label' => 'Tip i model motora (14.)',        'mandatory' => true],
        ['label' => 'Godina proizvodnje (B)',          'mandatory' => true],
    ],
];

/*
|------------------------------------------------------------------
| Strict start times (both public + backend) for provider “Petar”
| C + B + E: Only these start times are ever allowed/shown/stored.
|------------------------------------------------------------------
*/
$config['ea_allowed_starts'] = [
    '08:00','08:45','09:15','10:00','10:45','11:15',
    '12:00','12:45','13:15','14:00','14:45','15:15',
    '16:00','16:45','17:15'
];

/*
| Keep custom-field rows available in Settings (UI cap).
| If you previously upped this to 10, leave it at 10+.
*/
$config['ea_max_custom_fields'] = 12;
