<?php

namespace App\Imports;

use App\Models\Developer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

// ToModel, WithValidation, WithBatchInserts, WithHeadingRow, ToCollection
// WithMapping, WithUpserts

class DevelopersImport extends ImportErrorHandler implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsFailures, SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Developer([
            'name' => $row['name'],
            'role' => $row['role'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => ['required', 'max:25'],
            '*.role' => ['max:25'],
        ];
    }

    /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        $this->dbErrors = $e->getMessage();
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->validationErrors[] = "There was an error on row {$failure->row()}. {$failure->errors()[0]}";
        }
    }

    public function validationErrors():? array
    {
        return $this->validationErrors;
    }

    public function dbErrors():? string
    {
        return $this->dbErrors;
    }

    public function batchSize(): int
    {
        return 100;
    }
}
