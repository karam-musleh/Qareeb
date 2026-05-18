<?php

namespace App\Enum;

enum InitiativeType: string
{
    case FREE_HUB  = 'free_hub';   // هب مجاني
    case TRAINING  = 'training';   // تدريب
    case WORKSHOP  = 'workshop';   // ورك شوب
    case OTHER     = 'other';      // أخرى
}
