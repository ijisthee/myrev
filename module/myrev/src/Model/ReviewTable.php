<?php

namespace myrev\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class ReviewTable
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * ReviewTable constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return Review[]
     */
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    /**
     * @param $id
     * @return Review
     */
    public function getReview($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeExceptioe(sprintf(
                'Could not find Review with ID %d',
                $id
            ));
        }
        return $row;
    }

    /**
     * @param Review $review
     * @return Review
     */
    public function saveReview(Review $review)
    {
        $data = [
            'artist' => $review->artist,
            'title'  => $review->title,
        ];

        $id = (int) $album->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return $this->getReview($this->tableGateway->getLastInsertValue());
        }

        if (! $this->getReview($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    /**
     * @param $id
     */
    public function deleteReview($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}