<?php

/**
 * Created by Cristian.
 * Date: 02/10/16 07:56 PM.
 */

namespace Facilitador\Support\Reliese\Meta;

/**
 * Created by Cristian.
 * Date: 18/09/16 06:50 PM.
 */
interface Schema
{
    /**
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function connection();

    /**
     * @return string
     */
    public function schema();

    /**
     * @return \Facilitador\Support\Reliese\Meta\Blueprint[]
     */
    public function tables();

    /**
     * @param string $table
     *
     * @return bool
     */
    public function has($table);

    /**
     * @param string $table
     *
     * @return \Facilitador\Support\Reliese\Meta\Blueprint
     */
    public function table($table);

    /**
     * @param \Facilitador\Support\Reliese\Meta\Blueprint $table
     *
     * @return array
     */
    public function referencing(Blueprint $table);
}
