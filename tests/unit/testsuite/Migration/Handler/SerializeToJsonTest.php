<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Migration\Handler;

class SerializeToJsonTest extends \PHPUnit_Framework_TestCase
{
    public function testHandle()
    {
        $array = ['some_field' => 'value'];
        $fieldName = 'fieldname';
        /** @var \Migration\Resource\Record|\PHPUnit_Framework_MockObject_MockObject $record */
        $record = $this->getMock('Migration\Resource\Record', ['setValue', 'getValue', 'getFields'], [], '', false);
        $record->expects($this->any())->method('getFields')->willReturn([$fieldName]);
        $record->expects($this->any())->method('getValue')->with($fieldName)->willReturn(serialize($array));
        $record->expects($this->any())->method('setValue')->with($fieldName, json_encode($array));

        $record2 = $this->getMockBuilder('Migration\Resource\Record')->disableOriginalConstructor()->getMock();

        $handler = new SerializeToJson();
        $handler->setField($fieldName);
        $handler->handle($record, $record2);
    }
}
