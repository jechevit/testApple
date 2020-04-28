<?php

namespace core\services;

use core\entities\Apple;
use core\forms\AppleCreateForm;
use core\repositories\AppleRepository;
use yii\db\StaleObjectException;

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

    public function create(AppleCreateForm $form)
    {
        $apple = Apple::create($form->color);
        $this->appleRepository->save($apple);

        return $apple;
    }

    /**
     * @param int $id
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function remove(int $id)
    {
        $post = $this->appleRepository->get($id);
        $this->appleRepository->remove($post);
    }
}