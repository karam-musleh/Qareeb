<?php
namespace App\Enum;

enum InitiativeStatus: string
{
    case PENDING      = 'pending';
    case ACTIVE       = 'active';
    case REJECTED     = 'rejected';
    case ENDED        = 'ended';
    case COMING_SOON  = 'coming_soon';
}
