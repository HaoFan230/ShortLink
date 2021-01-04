<?php

namespace App\Exports;

use App\Link;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Auth;

class LinksExport implements FromCollection,WithHeadings,ShouldAutoSize,WithMapping,WithColumnWidths
{
    /**
     * 修改一下需要返回的数据
     * @var Invoice $invoice
    */
    public function map($invoice): array
    {
        return [
            route('link.show',$invoice->shortkey),
            $invoice->url,
            $invoice->type == "longterm" ? '长期' : '短期',
            $invoice->expiratime ?? '-',
            $invoice->status ? '生效' : '失效',
        ];
    }

    // 自定义列宽
    public function columnWidths(): array
    {
        return [
            'C' => 12,
            'E' => 12,            
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Link::whereUserId(Auth::user()->id)
            ->get(['shortkey', 'url', 'type','expiratime']);
    }

    // 添加表头标题
    public function headings() : array
    {
        return [
            '短网址','源网址','类型','过期时间','状态'
        ];
    }
}
