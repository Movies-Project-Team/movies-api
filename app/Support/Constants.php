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

    public const ORDER_BY_DESC = "DESC";
    public const ORDER_BY_ASC = "ASC";

    public const ORDER_BY_LIST = [
        self::ORDER_BY_DESC,
        self::ORDER_BY_ASC,
    ];

    public const PERMISSION_ADULT = 1;
    public const PERMISSION_CHILD = 2;

    public const PERMISSION = [
        self::PERMISSION_ADULT,
        self::PERMISSION_CHILD
    ];
}