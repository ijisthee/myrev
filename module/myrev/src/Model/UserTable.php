<?php

namespace myrev\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class UserTable
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * UserTable constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return User[]
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    /**
     * @param $id
     * @return User
     */
    public function getUser($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['user_id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeExceptioe(sprintf(
                'Could not find User with ID %d',
                $id
            ));
        }
        return $row;
    }

    /**
     * @param Album $album
     */
    public function saveUser(Album $album)
    {
        $data = [
            'artist' => $album->artist,
            'title'  => $album->title,
        ];

        $id = (int) $album->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getAlbum($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }
        $this->tableGateway->update($data, ['user_id' => $id]);
    }

    /**
     * @param $id
     */
    public function deleteUser($id)
    {
        $this->tableGateway->delete(['user_id' => (int) $id]);
    }
}