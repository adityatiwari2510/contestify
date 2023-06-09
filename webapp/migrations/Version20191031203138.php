<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Language;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191031203138 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function isTransactional(): bool
    {
        return false;
    }

    public function getDescription(): string
    {
        return 'add .py to Python 3 extension list and remove it for Python 2';
    }

    public function up(Schema $schema): void
    {
        $em = $this->container->get('doctrine')->getManager();
        /** @var Language $python2 */
        $python2 = $em->getRepository(Language::class)->find('py2');
        /** @var Language $python3 */
        $python3 = $em->getRepository(Language::class)->find('py3');
        if ($python2 === null ||
            $python3 === null ||
            $python2->getAllowSubmit() ||
            $python3->getAllowSubmit() ||
            $python2->getExtensions() !== ['py2', 'py'] ||
            $python3->getExtensions() !== ['py3']) {
            return;
        }

        $this->addSql('UPDATE language SET extensions = \'["py3","py"]\' WHERE langid = \'py3\'');
        $this->addSql('UPDATE language SET extensions = \'["py2"]\' WHERE langid = \'py2\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $em = $this->container->get('doctrine')->getManager();
        /** @var Language $python2 */
        $python2 = $em->getRepository(Language::class)->find('py2');
        /** @var Language $python3 */
        $python3 = $em->getRepository(Language::class)->find('py3');

        if ($python2 === null ||
            $python3 === null ||
            $python2->getAllowSubmit() ||
            $python3->getAllowSubmit() ||
            $python2->getExtensions() !== ['py2', 'py'] ||
            $python3->getExtensions() !== ['py3']) {
            return;
        }

        $this->addSql('UPDATE language SET extensions = \'["py2","py"]\' WHERE langid = \'py2\'');
        $this->addSql('UPDATE language SET extensions = \'["py"]\' WHERE langid = \'py3\'');
    }
}
