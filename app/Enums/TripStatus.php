<?php

namespace App\Enums;

enum TripStatus: string
{
    case STARTED = 'started';
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}