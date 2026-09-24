<?php

namespace App\ViewComposers;

use App\Models\Seguro;
use Illuminate\View\View;

class AlertaSeguroComposer
{
    public function compose(View $view): void
    {
        $segurosProximosVencimento = Seguro::where(
            'status',
            'proximo_do_vencimento'
        )->count();

        $segurosVencidos = Seguro::where(
            'status',
            'vencido'
        )->count();

        $view->with([
            'alertasSeguros' => $segurosProximosVencimento + $segurosVencidos,
            'segurosProximosVencimento' => $segurosProximosVencimento,
            'segurosVencidos' => $segurosVencidos,
        ]);
    }
}