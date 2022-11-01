<?php

namespace Auth\Clients\Domain\User;

interface UserSaveRepository
{
    public function save(User $user): void;
}