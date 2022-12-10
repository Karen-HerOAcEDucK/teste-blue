<div class="container">
    <div>
        <h3>Listagem dos Inventários</h3>
        <p>Aqui você poderá visualizar todos os inventários de Computadores.</p>
    </div>
    <div class="div-table mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Cod. de Indentificação</th>
                    <th scope="col">Data do Inventário</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventorys as $inventory) : ?>
                    <tr>
                        <th scope="row"><?= $inventory['id'] ?></th>
                        <td><?= $inventory['brand_name'] ?></td>
                        <td><?= $inventory['model_computer'] ?></td>
                        <td><?= $inventory['amount'] ?></td>
                        <td><?= $inventory['identification_code_computer'] ?></td>
                        <td><?= $inventory['date_inventory'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>