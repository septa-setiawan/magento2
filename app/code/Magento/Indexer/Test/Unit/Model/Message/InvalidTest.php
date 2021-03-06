<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Indexer\Test\Unit\Model\Message;

class InvalidTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Indexer\Model\Indexer
     */
    private $indexerMock = null;

    /**
     * @var \Magento\Indexer\Model\Message\Invalid
     */
    protected $model;

    /**
     * Set up test
     */
    protected function setUp()
    {
        $collectionMock = $this->getMock(
            '\Magento\Indexer\Model\Indexer\Collection',
            ['getItems'],
            [],
            '',
            false
        );

        $this->indexerMock = $this->getMock(
            '\Magento\Indexer\Model\Indexer',
            ['getStatus'],
            [],
            '',
            false
        );

        $collectionMock->expects($this->any())->method('getItems')->with()->willReturn([$this->indexerMock]);

        $this->model = new \Magento\Indexer\Model\Message\Invalid(
            $collectionMock
        );
    }

    public function testDisplayMessage()
    {
        $this->indexerMock->expects($this->any())->method('getStatus')->with()
            ->willReturn(\Magento\Indexer\Model\Indexer\State::STATUS_INVALID);

        $this->assertTrue($this->model->isDisplayed());
    }

    public function testHideMessage()
    {
        $this->indexerMock->expects($this->any())->method('getStatus')->with()
            ->willReturn('Status other than "invalid"');

        $this->assertFalse($this->model->isDisplayed());
    }
}
