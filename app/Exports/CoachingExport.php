<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class CoachingExport implements FromCollection, WithHeadings, WithColumnWidths
{
    protected $startDate;
    protected $endDate;
    protected $monthFilter;

    public function __construct($startDate, $endDate, $monthFilter)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->monthFilter = $monthFilter;
    }

    public function collection()
    {
        return collect($this->getList());
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIP',
            'Jabatan',
            'Unit Kerja',
            'Nomor HP',
            'Email',
            'Materi Coaching',
            'Tanggal Pengajuan',
            'Tanggal Fix',
            'Tanggal Selesai',
            'Jam Pengajuan',
            'Jam Fix',
            'Kode',
            'Media Teleconference',
            'Petugas Yang Menangani',
            'VA Yang Menangani',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 30,
            'G' => 40,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 30,
            'O' => 30,
            'P' => 30,
        ];
    }

    private function getList(): array
    {
        // Set the locale to Indonesian
        setlocale(LC_TIME, 'id_ID.utf8');

        $query = DB::table('coachings AS c')
            ->select(
                'c.nama',
                DB::raw("CONCAT('\'', CAST(c.nip AS CHAR)) as nip"),
                'c.jabatan',
                'c.unitkerja',
                DB::raw("CONCAT('\'', c.nomorhp) as nomorhp"),
                'c.email',
                'cm.nama_materi AS materi',
                DB::raw("DATE_FORMAT(c.tanggal, '%e %b %Y') as tanggal_pengajuan"),
                DB::raw("DATE_FORMAT(c.tanggal_fix, '%e %b %Y') as tanggal_fix"),
                DB::raw("DATE_FORMAT(c.tanggal_selesai, '%e %b %Y') as tanggal_selesai"),
                'j.jam AS jam_usul',
                'ja.jam AS jam_final',
                'c.kode',
                'za.media_teleconference AS media',
                'u.name as nama_petugas',
                'ua.name as nama_va'
            )
            ->join('coaching_materi AS cm', 'c.elemenmanajemen', '=', 'cm.id')
            ->join('jams AS j', 'c.jam', '=', 'j.id')
            ->join('zooms AS za', 'c.zoom_id', '=', 'za.id')
            ->join('jams AS ja', 'c.jam_fix', '=', 'ja.id')
            ->leftJoin('users AS u', 'c.petugas_id', '=', 'u.id')
            ->leftJoin('users AS ua', 'c.va_id', '=', 'ua.id');

        // Apply date filter if start date and end date are provided
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('c.tanggal', [$this->startDate, $this->endDate]);
        }

        if ($this->monthFilter) {
            $query->whereMonth('c.tanggal', '=', $this->monthFilter);
        }

        $results = $query->get();

        return $results->toArray();
    }
}
