<?php

declare(strict_types=1);

namespace Oop\Renderer;

use Oop\Invoice;

class InvoiceHtmlRenderer implements InvoiceRendererInterface
{
    public function render(Invoice $invoice): void
    {
        echo sprintf("<h1>INVOICE #%s</h1>", $invoice->getId());
        echo '<pre>';
        (new InvoiceCliRenderer())->render($invoice);
        echo '</pre>';
    }
}