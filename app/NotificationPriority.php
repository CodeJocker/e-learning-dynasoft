<?php

namespace App;

enum NotificationPriority : string
{
    case LOW = "low";
    case NORMAL = "normal";
    case HIGH = "high";
    case CRITICAL = "critical";
}
