<?php

namespace Main;

use Oop\InvoiceCliRenderer;
use Oop\InvoiceHtmlRenderer;
use Oop\InvoiceBuilder;
use Oop\InvoiceManager;
use Oop\InvoiceValidatorFactory;
use Oop\Price;
use Symfony\Component\ErrorHandler\Debug;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();

// Configuration
$discounted = ($argv[1] ?? '') === 'discount';
//$invoice = InvoiceManager::getInstance()->getFruitInvoice($discounted);

$invoice = (new InvoiceBuilder())
    ->setId(123)
    ->addLine(300, 'Apples', Price::euro(39))
    ->removeLine('Apples')
    ->addLine(1, 'Bananas', Price::euro(60))
    ->increment('Bananas', 1)
    ->addLine(1, 'Bag', Price::euro(100))
    ->addLine(300, 'Apples', Price::euro(39))
    ->getInvoice()
;


(new InvoiceValidatorFactory())
    ->getInvoiceValidator($invoice)
    ->validate($invoice)
;

$cli = PHP_SAPI === 'cli';
/** @var \Oop\InvoiceRendererInterface $renderer */
$renderer = $cli ? new InvoiceCliRenderer() : new InvoiceHtmlRenderer();
$renderer->render($invoice);
