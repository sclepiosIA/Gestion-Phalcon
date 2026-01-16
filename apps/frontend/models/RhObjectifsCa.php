<?
use Phalcon\ModelBase;

class RhObjectifsCa extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $rhobca_id;

	/**
	 * @Column(column='profile_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $rhobca_profile_id;

	/**
	 * @Column(column='annee', type='integer', mtype='int', nullable=false, key='MUL')
	 */
	public $rhobca_annee;

	/**
	 * @Column(column='trimestre', type='integer', mtype='int', nullable=false)
	 */
	public $rhobca_trimestre;

	/**
	 * @Column(column='objectif_ca', type='decimal', mtype='decimal', nullable=false, 'length': 15)
	 */
	public $rhobca_objectif_ca;

	/**
	 * @Column(column='ca_realise', type='decimal', mtype='decimal', nullable=true, default='0.00', 'length': 15)
	 */
	public $rhobca_ca_realise;

	/**
	 * @Column(column='notes', type='text', mtype='text', nullable=true)
	 */
	public $rhobca_notes;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $rhobca_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('rhobca_profile_id', 'Profiles', 'pr_id', array('alias' => 'profiles_profile_id'));

        $this->setSource('rh_objectifs_ca');
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
            'id' => 'rhobca_id',
			'profile_id' => 'rhobca_profile_id',
			'annee' => 'rhobca_annee',
			'trimestre' => 'rhobca_trimestre',
			'objectif_ca' => 'rhobca_objectif_ca',
			'ca_realise' => 'rhobca_ca_realise',
			'notes' => 'rhobca_notes',
			'created_at' => 'rhobca_created_at'
        );
    }

}
