<?php

namespace App\Exports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class FormulirExport implements FromCollection, WithHeadings, WithColumnWidths
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
            'Keluhan',
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
    
        $query = DB::table('formulirs AS f')
            ->select(
                'f.nama',
                DB::raw("CONCAT('\'', CAST(f.nip AS CHAR)) as nip"), 
                'f.jabatan',
                'f.unitkerja',
                DB::raw("CONCAT('\'', f.nomorhp) as nomorhp"),
                'f.email',
                DB::raw("CONCAT('\'', f.keluhan) as keluhan"),
                DB::raw("DATE_FORMAT(f.tanggal, '%e %b %Y') as tanggal_pengajuan"),
                DB::raw("DATE_FORMAT(f.tanggal_fix, '%e %b %Y') as tanggal_fix"),
                DB::raw("DATE_FORMAT(f.tanggal_selesai, '%e %b %Y') as tanggal_selesai"),
                'j.jam AS jam_usul',
                'ja.jam AS jam_final',
                'f.kode',
                'za.media_teleconference AS media',
                'u.name as nama_petugas',
                'ua.name as nama_va'
            )
            ->join('jams AS j', 'f.jam', '=', 'j.id')
            ->join('zooms AS za', 'f.zoom_id', '=', 'za.id')
            ->join('jams AS ja', 'f.jam_fix', '=', 'ja.id')
            ->leftJoin('users AS u', 'f.petugas_id', '=', 'u.id')
            ->leftJoin('users AS ua', 'f.va_id', '=', 'ua.id');
    
        // Apply date filter if start date and end date are provided
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('f.tanggal', [$this->startDate, $this->endDate]);
        }
    
        if ($this->monthFilter) {
            $query->whereMonth('f.tanggal', '=', $this->monthFilter);
        }

        $results = $query->get();
    
        return $results->toArray();
    }    
}
