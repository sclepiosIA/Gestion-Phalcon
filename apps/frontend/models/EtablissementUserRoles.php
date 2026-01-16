<?
use Phalcon\ModelBase;

class EtablissementUserRoles extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $etusro_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $etusro_user_id;

	/**
	 * @Column(column='role', type='string', mtype='varchar', nullable=false, 'length': 32)
	 */
	public $etusro_role;

	/**
	 * @Column(column='assigned_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $etusro_assigned_at;

	/**
	 * @Column(column='assigned_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $etusro_assigned_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('etusro_assigned_by', 'Profiles', 'pr_id', array('alias' => 'profiles_assigned_by'));
		$this->belongsTo('etusro_user_id', 'EtablissementUsers', 'etus_id', array('alias' => 'etablissement_users_user_id'));

        $this->setSource('etablissement_user_roles');
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
            'id' => 'etusro_id',
			'user_id' => 'etusro_user_id',
			'role' => 'etusro_role',
			'assigned_at' => 'etusro_assigned_at',
			'assigned_by' => 'etusro_assigned_by'
        );
    }

}
