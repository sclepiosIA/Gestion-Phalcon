<?php
use Phalcon\ModelBase;

class ModelesTaches extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $mota_id;

	/**
	 * @Column(column='categorie_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $mota_categorie_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $mota_titre;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $mota_description;

	/**
	 * @Column(column='priorite', type='', mtype='enum', nullable=false, default='medium', 'length': 'low,medium,high')
	 */
	public $mota_priorite;

	/**
	 * @Column(column='ordre', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $mota_ordre;

	/**
	 * @Column(column='delai_jours', type='integer', mtype='int', nullable=true)
	 */
	public $mota_delai_jours;

	/**
	 * @Column(column='actif', type='integer', mtype='tinyint', nullable=true, default='1', 'length': 1)
	 */
	public $mota_actif;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $mota_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('mota_categorie_id', 'CategoriesTaches', 'cata_id', array('alias' => 'categories_taches_categorie_id'));

        $this->setSource('modeles_taches');
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
            'id' => 'mota_id',
			'categorie_id' => 'mota_categorie_id',
			'titre' => 'mota_titre',
			'description' => 'mota_description',
			'priorite' => 'mota_priorite',
			'ordre' => 'mota_ordre',
			'delai_jours' => 'mota_delai_jours',
			'actif' => 'mota_actif',
			'created_at' => 'mota_created_at'
        );
    }

}
