<?php

namespace App\Imports;

abstract class ImportErrorHandler
{
    /**
     * The connection name for the model.
     *
     * @var array|null
     */
    protected $validationErrors;

    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $dbErrors;

    /**
     * Handles the file validation Errors.
     */
    abstract protected function validationErrors():? array;

    /**
     * Handles the DB Errors.
     */
    abstract protected function dbErrors():? string;
}
