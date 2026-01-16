<?
use Phalcon\ModelBase;

class RhAbsences extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $rhab_id;

	/**
	 * @Column(column='profile_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $rhab_profile_id;

	/**
	 * @Column(column='date_debut', type='date', mtype='date', nullable=false, key='MUL')
	 */
	public $rhab_date_debut;

	/**
	 * @Column(column='date_fin', type='date', mtype='date', nullable=false)
	 */
	public $rhab_date_fin;

	/**
	 * @Column(column='type_absence', type='', mtype='enum', nullable=false, key='MUL', 'length': 'conges_payes,maladie,rtt,formation,non_justifie')
	 */
	public $rhab_type_absence;

	/**
	 * @Column(column='motif', type='text', mtype='text', nullable=true)
	 */
	public $rhab_motif;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=true, default='en_attente', 'length': 'en_attente,validee,refusee')
	 */
	public $rhab_statut;

	/**
	 * @Column(column='validee_par', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $rhab_validee_par;

	/**
	 * @Column(column='validee_le', type='datetime', mtype='datetime', nullable=true)
	 */
	public $rhab_validee_le;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $rhab_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $rhab_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('rhab_profile_id', 'Profiles', 'pr_id', array('alias' => 'profiles_profile_id'));
		$this->belongsTo('rhab_validee_par', 'Profiles', 'pr_id', array('alias' => 'profiles_validee_par'));

        $this->setSource('rh_absences');
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
            'id' => 'rhab_id',
			'profile_id' => 'rhab_profile_id',
			'date_debut' => 'rhab_date_debut',
			'date_fin' => 'rhab_date_fin',
			'type_absence' => 'rhab_type_absence',
			'motif' => 'rhab_motif',
			'statut' => 'rhab_statut',
			'validee_par' => 'rhab_validee_par',
			'validee_le' => 'rhab_validee_le',
			'created_at' => 'rhab_created_at',
			'updated_at' => 'rhab_updated_at'
        );
    }

}
