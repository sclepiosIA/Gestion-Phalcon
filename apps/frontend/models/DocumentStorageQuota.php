<?php
use Phalcon\ModelBase;

class DocumentStorageQuota extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $dostqu_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='UNI', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dostqu_user_id;

	/**
	 * @Column(column='quota_bytes', type='integer', mtype='bigint', nullable=true, default='5368709120')
	 */
	public $dostqu_quota_bytes;

	/**
	 * @Column(column='used_bytes', type='integer', mtype='bigint', nullable=true, default='0')
	 */
	public $dostqu_used_bytes;

	/**
	 * @Column(column='last_updated', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $dostqu_last_updated;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('dostqu_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('document_storage_quota');
        parent::initialize();
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap():array
    {
        return array(
            'id' => 'dostqu_id',
			'user_id' => 'dostqu_user_id',
			'quota_bytes' => 'dostqu_quota_bytes',
			'used_bytes' => 'dostqu_used_bytes',
			'last_updated' => 'dostqu_last_updated'
        );
    }

}
