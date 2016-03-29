<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\MoheyUser;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MoheyUserToTextTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (user) to a string (number).
     *
     * @param  MoheyUser|null $user
     * @return string
     */
    public function transform($user)
    {
        if (null === $user) {
            return '';
        }

        return $user->getUserName();
    }

    /**
     * Transforms a string (number) to an object (user).
     *
     * @param  string $userId
     * @return user|null
     * @throws TransformationFailedException if object (user) is not found.
     */
    public function reverseTransform($userId)
    {
        // no issue number? It's optional, so that's ok
        if (!$userId) {
            return;
        }

        $user = $this->manager
            ->getRepository('AppBundle:MoheyUser')
            // query for the issue with this id
            ->find($userId)
        ;

        if (null === $user) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'A user with id "%s" does not exist!',
                $issueId
            ));
        }

        return $user;
    }
}

