<?php

namespace App\Imports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

// ToModel, WithValidation, WithBatchInserts, WithHeadingRow, ToCollection
// WithMapping, WithUpserts

class ProjectsImport extends ImportErrorHandler implements ToModel, WithHeadingRow, WithBatchInserts, WithValidation, WithUpserts, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsFailures, SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Project([
            'title'         => $row['title'],
            'description'   => $row['description'],
            'code'          => $row['code'],
            'due_date'      => $row['due_date']
        ]);
    }

    public function prepareForValidation($data)
    {
        $data['due_date'] = $data['due_date'] > 0 ? Date::excelToDateTimeObject($data['due_date']) : null;

        return $data;
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'code';
    }

    public function rules(): array
    {
        return [
            '*.title'       => ['required', 'min:6', 'max:255'],
            '*.description' => ['max:255'],
            '*.code'        => ['required', 'digits:4'],
            '*.due_date'    => ['nullable', 'date'],
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
