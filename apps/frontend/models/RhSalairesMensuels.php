<?php
use Phalcon\ModelBase;

class RhSalairesMensuels extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $rhsame_id;

	/**
	 * @Column(column='profile_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $rhsame_profile_id;

	/**
	 * @Column(column='mois', type='date', mtype='date', nullable=false, key='MUL')
	 */
	public $rhsame_mois;

	/**
	 * @Column(column='salaire_brut', type='decimal', mtype='decimal', nullable=false, 'length': 15)
	 */
	public $rhsame_salaire_brut;

	/**
	 * @Column(column='salaire_net', type='decimal', mtype='decimal', nullable=false, 'length': 15)
	 */
	public $rhsame_salaire_net;

	/**
	 * @Column(column='cotisations_patronales', type='decimal', mtype='decimal', nullable=false, 'length': 15)
	 */
	public $rhsame_cotisations_patronales;

	/**
	 * @Column(column='cotisations_salariales', type='decimal', mtype='decimal', nullable=false, 'length': 15)
	 */
	public $rhsame_cotisations_salariales;

	/**
	 * @Column(column='primes', type='decimal', mtype='decimal', nullable=true, default='0.00', 'length': 15)
	 */
	public $rhsame_primes;

	/**
	 * @Column(column='heures_supplementaires', type='decimal', mtype='decimal', nullable=true, default='0.00', 'length': 15)
	 */
	public $rhsame_heures_supplementaires;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=true, default='prevu', key='MUL', 'length': 'prevu,paye,en_cours')
	 */
	public $rhsame_statut;

	/**
	 * @Column(column='date_paiement', type='date', mtype='date', nullable=true)
	 */
	public $rhsame_date_paiement;

	/**
	 * @Column(column='notes', type='text', mtype='text', nullable=true)
	 */
	public $rhsame_notes;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $rhsame_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $rhsame_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('rhsame_profile_id', 'Profiles', 'pr_id', array('alias' => 'profiles_profile_id'));

        $this->setSource('rh_salaires_mensuels');
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
            'id' => 'rhsame_id',
			'profile_id' => 'rhsame_profile_id',
			'mois' => 'rhsame_mois',
			'salaire_brut' => 'rhsame_salaire_brut',
			'salaire_net' => 'rhsame_salaire_net',
			'cotisations_patronales' => 'rhsame_cotisations_patronales',
			'cotisations_salariales' => 'rhsame_cotisations_salariales',
			'primes' => 'rhsame_primes',
			'heures_supplementaires' => 'rhsame_heures_supplementaires',
			'statut' => 'rhsame_statut',
			'date_paiement' => 'rhsame_date_paiement',
			'notes' => 'rhsame_notes',
			'created_at' => 'rhsame_created_at',
			'updated_at' => 'rhsame_updated_at'
        );
    }

}
