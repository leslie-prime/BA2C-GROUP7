<?php

// ---------------------------
// BUILDER PATTERN
// ---------------------------
// Intent (short): separate construction of a complex object from its
// representation so the same construction process can create different
// representations. In PHP this often surfaces as a fluent builder for
// objects with many optional parameters.

class Product
{
    public string $name;
    public ?string $description = null;
    public array $options = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

// Builder interface (optional but documents contract)
interface ProductBuilderInterface
{
    public function setDescription(string $desc): self;
    public function addOption(string $key, $value): self;
    public function build(): Product;
}

class ProductBuilder implements ProductBuilderInterface
{
    private Product $product;

    public function __construct(string $name)
    {
        // Start from a minimal product and incrementally configure it
        $this->product = new Product($name);
    }

    public function setDescription(string $desc): self
    {
        $this->product->description = $desc;
        return $this;
    }

    public function addOption(string $key, $value): self
    {
        $this->product->options[$key] = $value;
        return $this;
    }

    public function build(): Product
    {
        // Optionally validate before returning
        if (empty($this->product->name)) {
            throw new RuntimeException('Product must have a name');
        }
        return $this->product;
    }
}

// Example usage of Builder
function demoBuilder()
{
    echo "--- Builder demo ---\n";

    $builder = new ProductBuilder('MyProduct');
    $product = $builder
        ->setDescription('A product built via the Builder pattern')
        ->addOption('color', 'red')
        ->addOption('size', 'L')
        ->build();

    print_r($product);

    // ALTERNATIVES & NOTES:
    // - Fluent static named constructor (no builder class):
    //   Product::create('name')->withDesc('...')->withOption('k','v');
    //   This keeps API similar but can make Product mutable and mixes
    //   construction with representation.
    // - Telescoping constructors (multiple constructors with many params)
    //   are harder to read and maintain when there are many optional params.
    // - Using an immutable builder: builder returns a new builder instance
    //   on each call (persistent style) if you need immutability.
}


// ---------------------------
// RUN DEMOS
// ---------------------------
if (PHP_SAPI === 'cli' || (isset($_SERVER['REMOTE_ADDR']) === false)) {
    // only auto-run when executed directly (not when included by other code)
    demoChainOfResponsibility();
    demoBuilder();
}
?>