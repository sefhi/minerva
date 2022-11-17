<?php

namespace Auth\Domain\User;

interface UserSaveRepository
{
    public function save(User $user): void;
}
