<?php

namespace BisonLab\ProductMasterBundle\Command;

use BisonLab\ProductMasterBundle\Entity\Product as Product;
use BisonLab\ProductMasterBundle\Entity\ProductCatalog as ProductCatalog;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Imports a csv file of products
 *
 * @author Thomas Lundquist <thomasez@redpill-linpro.com>
 */
class RlProductMasterImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('rl:productmaster:import:products')
            ->addArgument('filename', InputArgument::REQUIRED, 'flename')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->filename = $input->getArgument('filename');
        $this->verbose = $input->getOption('verbose');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Debug mode is <comment>%s</comment>.', $input->getOption('no-debug') ? 'off' : 'on'));
        $output->writeln('');

        if (!$this->filename) {
            return;
        }

        $this->entityManager = $this->getContainer()->get('doctrine')->getManager();
echo "gc:" . get_class($this->entityManager) . "\n";

        $this->catalog = $this->entityManager->getRepository('BisonLabProductMasterBundle:Catalog')->find(1);

        $output->writeln(sprintf('Got a filename', $input->getOption('env')));
        
        $row = 1;

        if (($handle = fopen($this->filename, 'r'))) {
            $iterations = 0;
          
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Blank line or equivalent.
                if (count($data) < 3) {
                    continue;
                }
              
                if ($row == 1) {
                    // Use the column headers to get the correct attributes if they switch places or if some are added
                    foreach ($data as $col => $header) {
                        // $header = strtolower($header);
                        $header = trim($header);
                        $mapping[$col] = $header;
                    }
                    $row++;
                    continue;
                }
              
                foreach ($data as $col => $value) {
                    $attribute = $mapping[$col];
                    $valuesArray[$attribute] = $value;
                }

            $this->_import($valuesArray);

            }
        }
        $this->entityManager->flush();
    }

    private function _import($data) 
    {
// var_dump($data);
// return;
        $product = new Product();
        $product_catalog = new ProductCatalog();
        $product_catalog->setCatalog($this->catalog);
        $product_catalog->setProduct($product);

/*
   Produktgruppe,Etabl.kode,Prod.kode,,Etabl.kostnad,"Pris, ink mva ",Innhold,Bindingstid,Vilkår
*/
        if($data['Navn']) {
            $product->setName($data['Navn']);
        }
        if($data['Etabl.kostnad']) {
            $price = preg_replace('/\D/', '', $data['Etabl.kostnad']);
if (!$price) { $price = 0; }
            $product->setOneTimePrice($price);
        }
        if($data['Pris, ink mva']) {
            $price = preg_replace('/\D/', '', $data['Pris, ink mva']);
if (!$price) { $price = 0; }
            $product->setSubscriptionPrice($price);
        }
        if($data['Innhold']) {
            $product->setDescription($data['Innhold']);
        }
        if($data['Produktgruppe']) {
            $product->setProductGroup($data['Produktgruppe']);
        }
        if($data['Produktgruppe'] == "Etablering") {
            $product->setProductType('one_time_charge');
        } else {
            $product->setProductType('subscription');
        }

        if($data['Etabl.kode']) {
            $product_catalog->setExternalProductId($data['Etabl.kode']);
        }
        if($data['Prod.kode']) {
            $product_catalog->setExternalProductId($data['Prod.kode']);
        }

echo "Har:" . $product->getName();
        $this->entityManager->persist($product);
        $this->entityManager->persist($product_catalog);

    }

}

