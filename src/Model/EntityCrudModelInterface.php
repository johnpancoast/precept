<?php
/**
 * @package       johnpancoast/precept
 * @copyright (c) 2017 John Pancoast <johnpancoaster@gmail.com>
 * @license       MIT
 */

namespace Pancoast\Precept\Model;

use Pancoast\Common\Exception\InvalidArgumentException;
use Pancoast\Common\ObjectRegistry\Exception\ObjectKeyNotRegisteredException;
use Pancoast\Common\ObjectRegistry\Exception\ObjectKeyNotSupportedException;
use Pancoast\Precept\Model\Exception\EntityValidationException;
use Pancoast\Precept\Model\Exception\ModelNotLoadedException;
use Pancoast\Precept\Model\Exception\UnknownEntityException;
use Pancoast\Precept\Entity\EntityInterface;

/**
 * Crud entity model interface
 *
 * This is where you'll definitely see a break from DDD as CRUD implies persistence which DDD would have separated in
 * other layers. That said, this still separates our "model" from other parts of the application and is especially
 * useful for cases where your application's entities directly map to models and where those models need CRUD type
 * behavior.
 *
 * @author John Pancoast <johnpancoaster@gmail.com>
 */
interface EntityCrudModelInterface extends EntityModelInterface
{
    /**
     * Create model, leave in loaded state
     *
     * @param EntityInterface $entity
     * @param bool $save Whether to save the state of the model after this operation. Call save() later to do same.
     *
     * @return int|string Id
     * @internal param bool $flush Should entity change in memory be flushed
     *
     */
    public function create(EntityInterface $entity, $save = false);

    /**
     * Update model, leave in updated state
     *
     * @param EntityInterface $entity
     * @param bool $save Whether to save the state of the model after this operation. Call save() later to do same.
     *
     * @return bool Success
     * @internal param bool $flush Should entity change in memory be flushed
     *
     */
    public function update(EntityInterface $entity, $save = false);

    /**
     * Get loaded entity
     *
     * @return EntityInterface
     * @throws ModelNotLoadedException
     */
    public function get();

    /**
     * Load entity from internal state using an id
     *
     * @param string|int $id
     *
     * @return bool Success
     * @throws InvalidArgumentException
     * @throws ObjectKeyNotRegisteredException
     * @throws ObjectKeyNotSupportedException
     */
    public function load($id);

    /**
     * Is entity loaded
     *
     * @param EntityInterface $entity If null, method returns true if any object is loaded
     *
     * @return bool
     * @throws UnknownEntityException
     * @throws EntityValidationException
     */
    public function isLoaded(EntityInterface $entity = null);

    /**
     * Is entity id loaded
     *
     * @param string|int $id
     *
     * @return bool
     */
    public function isLoadedId($id);

    /**
     * Load id and get loaded entity
     *
     * @param string|int $id
     *
     * @return EntityInterface
     * @throws ModelNotLoadedException
     * @throws InvalidArgumentException
     * @throws ObjectKeyNotRegisteredException
     * @throws ObjectKeyNotSupportedException
     */
    public function loadAndGet($id);

    /**
     * Delete currently loaded entity
     *
     * @param bool $save Whether to save the state of the model after this operation. Call save() later to do same.
     *
     * @return bool Success
     * @internal param bool $flush
     */
    public function delete($save = false);

    /**
     * Load id and delete it
     *
     * @param string|int $id
     * @param bool       $flush
     *
     * @return bool Success
     * @throws ModelNotLoadedException
     * @throws InvalidArgumentException
     * @throws ObjectKeyNotRegisteredException
     * @throws ObjectKeyNotSupportedException
     */
    public function loadAndDelete($id, $flush = false);

    /**
     * Save the current state of the model
     *
     * @return bool Success
     */
    public function save();
}
