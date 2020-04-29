<?php

namespace core\services;

use core\entities\Apple;
use core\forms\AppleCreateForm;
use core\helpers\AppleHelper;
use core\repositories\AppleRepository;
use DomainException;
use Exception;
use Throwable;
use yii\db\StaleObjectException;

/**
 * Class AppleService
 * @package core\services
 */
class AppleService
{
    /**
     * @var AppleRepository
     */
    private $appleRepository;

    /**
     * AppleService constructor.
     * @param AppleRepository $appleRepository
     */
    public function __construct(
        AppleRepository $appleRepository
    )
    {
        $this->appleRepository = $appleRepository;
    }

    /**
     * @param AppleCreateForm $form
     * @param bool $is_generator
     * @return Apple
     */
    public function create(AppleCreateForm $form = null, bool $is_generator = false): Apple
    {
        if (!$is_generator){
            $apple = Apple::create($form->color);
        } else {
            $apple = Apple::create($this->randomColor());
        }
        $this->appleRepository->save($apple);

        return $apple;
    }

    /**
     * @param int $id
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function remove(int $id): void
    {
        $post = $this->appleRepository->get($id);
        $this->appleRepository->remove($post);
    }

    /**
     * @param int $id
     */
    public function fall(int $id): void
    {
        $apple = $this->appleRepository->get($id);

        if ($apple->isRotten()){
            throw new DomainException('Нельзя уронить то, что уже упало');
        }

        $apple->fall();
        $this->appleRepository->save($apple);
    }

    /**
     * @param int $id
     * @throws Exception
     */
    public function rot(int $id): void
    {
        $apple = $this->appleRepository->get($id);

        if ($apple->isOnTree()){
            throw new DomainException('Яблоко на дереве не портится');
        }

        $apple->rot();
        $this->appleRepository->save($apple);
    }

    /**
     * @param int $id
     * @param int $piece
     */
    public function eat(int $id, int $piece): void
    {
        $apple = $this->appleRepository->get($id);

        if ($apple->isOnTree()) {
            throw new DomainException('Нельзя откусить яблока с дерева');
        }

        if ($apple->isRotten()) {
            throw new DomainException('Нельзя есть гнилое яблоко');
        }

        if ($piece > $apple->eaten) {
            throw new DomainException('Нельзя съесть то чего нет');
        }

        $apple->eat($piece);
        $this->appleRepository->save($apple);
    }

    public function generate(int $quantity)
    {
        for ($i = 1; $i <= $quantity; $i++){

            $apple = $this->create(null, true);
            $this->appleRepository->save($apple);
        }
    }

    private function randomColor()
    {
        return array_rand(AppleHelper::colorList());
    }
}