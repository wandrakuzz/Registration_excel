<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Validators\ValidationException;
use App\Notifications\EmailPassword;
use Illuminate\Support\Str;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation, WithEvents
{
    use RegistersEventListeners;

    private $rows = 0;

    public static function beforeImport(BeforeImport $event)
    {
        $worksheet = $event->reader->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // e.g. 10

        if ($highestRow < 2) {
            $error = \Illuminate\Validation\ValidationException::withMessages([]);
            $failure = new Failure(1, 'rows', [0 => 'Not enough rows!']);
            $failures = [0 => $failure];
            throw new ValidationException($error, $failures);
        }
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $this->rows = $rows->count();

        $password = Str::random(12);

        $hash = bcrypt($password);

        foreach ($rows as $row) {
            $user = User::updateOrCreate(
                [
                    'email'  => $row['email']
                ],
                [
                    'name'  => $row['full_name'],
                    'email' => $row['email'],
                    'password'  => $hash
                ]
            );

            $user->notify(new EmailPassword($password));
        }
    }

    public function rules(): array
    {
        return [
            'name'  => 'string',
            'email' => 'required|email|unique:users',
        ];
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
