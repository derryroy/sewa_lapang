<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mpdf
{
    public function generate($html)
    {
        include_once APPPATH . "../vendor/autoload.php";

        $config = array(
            'format' => 'A4',
            'orientation' => 'L'
        );

        $mpdf = new \Mpdf\Mpdf($config);

        $mpdf->SetHTMLHeader('
        <div>
            <div style="width:100px;float:right;">
                <h2 style="margin-left:5px;padding-top:35px;">ARENA</h2>
            </div>
            <div style="width:100px;float:right;">
                <img src="assets/front/img/logo.png">
            </div>
        </div>');
        $mpdf->SetHTMLFooter('
            <table width="100%">
                <tr>
                    <td width="33%">{DATE d-m-Y}</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" style="text-align: right;">C-TRA Arena</td>
                </tr>
            </table>');

        $mpdf->WriteHTML($html);
        // $mpdf->Output();

        $filename = 'Laporan Gor C-Tra ' . date('Y-m-d') . '.pdf';
        $mpdf->Output('upload/pdf/' . $filename, 'F');
        $data = file_get_contents(FCPATH . '/upload/pdf/' . $filename);
        force_download($filename, $data);
    }
}
