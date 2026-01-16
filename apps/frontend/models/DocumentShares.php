<?
use Phalcon\ModelBase;

class DocumentShares extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $dosh_id;

	/**
	 * @Column(column='document_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dosh_document_id;

	/**
	 * @Column(column='shared_with_user_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dosh_shared_with_user_id;

	/**
	 * @Column(column='permission_level', type='', mtype='enum', nullable=false, 'length': 'view,comment,edit,admin')
	 */
	public $dosh_permission_level;

	/**
	 * @Column(column='shared_by', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dosh_shared_by;

	/**
	 * @Column(column='shared_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $dosh_shared_at;

	/**
	 * @Column(column='expires_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $dosh_expires_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('dosh_document_id', 'Documents', 'do_id', array('alias' => 'documents_document_id'));
		$this->belongsTo('dosh_shared_by', 'Users', 'us_id', array('alias' => 'users_shared_by'));
		$this->belongsTo('dosh_shared_with_user_id', 'Users', 'us_id', array('alias' => 'users_shared_with_user_id'));

        $this->setSource('document_shares');
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
            'id' => 'dosh_id',
			'document_id' => 'dosh_document_id',
			'shared_with_user_id' => 'dosh_shared_with_user_id',
			'permission_level' => 'dosh_permission_level',
			'shared_by' => 'dosh_shared_by',
			'shared_at' => 'dosh_shared_at',
			'expires_at' => 'dosh_expires_at'
        );
    }

}
