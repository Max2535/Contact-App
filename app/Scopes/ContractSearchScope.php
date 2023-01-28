<?php

namespace App\Scopes;


class ContractSearchScope extends SearchScope
{
    protected $searchColumns = ['first_name', 'last_name', 'email', 'company.name'];
}
