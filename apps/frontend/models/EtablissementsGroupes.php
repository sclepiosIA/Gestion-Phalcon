<?
use Phalcon\ModelBase;

class EtablissementsGroupes extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $etgr_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $etgr_etablissement_id;

	/**
	 * @Column(column='groupe_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $etgr_groupe_id;

	/**
	 * @Column(column='date_entree', type='date', mtype='date', nullable=true)
	 */
	public $etgr_date_entree;

	/**
	 * @Column(column='date_sortie', type='date', mtype='date', nullable=true)
	 */
	public $etgr_date_sortie;

	/**
	 * @Column(column='est_etablissement_principal', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $etgr_est_etablissement_principal;

	/**
	 * @Column(column='role_dans_groupe', type='string', mtype='varchar', nullable=true, 'length': 255)
	 */
	public $etgr_role_dans_groupe;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $etgr_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('etgr_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('etgr_groupe_id', 'GroupesEtablissements', 'gret_id', array('alias' => 'groupes_etablissements_groupe_id'));

        $this->setSource('etablissements_groupes');
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
            'id' => 'etgr_id',
			'etablissement_id' => 'etgr_etablissement_id',
			'groupe_id' => 'etgr_groupe_id',
			'date_entree' => 'etgr_date_entree',
			'date_sortie' => 'etgr_date_sortie',
			'est_etablissement_principal' => 'etgr_est_etablissement_principal',
			'role_dans_groupe' => 'etgr_role_dans_groupe',
			'created_at' => 'etgr_created_at'
        );
    }

}
