<?php
namespace App\Support;

final class Constants {

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 2;

    public const STATUS_LIST = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    public const QUEUE_NAME_MAIL = "{mail}";

    public const EMAIL_BIND_OPEN = "{{";
    public const EMAIL_BIND_CLOSE = "}}";
}