<?php declare(strict_types=1);

namespace App\Interfaces\Requests;

interface ListUserRequestInterface
{
    public function getLimit(): ?int;

    public function getPaginate(): ?int;
}