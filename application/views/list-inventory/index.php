<div class="container-fluid">
    <div class="d-flex flex-row justify-content-between">
        <div>
            <h3>Listagem dos Inventários</h3>
            <p>Aqui você poderá visualizar todos os inventários de Computadores.</p>
        </div>
        <div class="d-flex flex-row justify-content-end align-items-center">
            <div class="m-1">
                <a href="<?= base_url("inventory/new") ?>" type="button" class="btn btn-primary">Adicionar items</a>
            </div>
            <div class="m-1">
                <a href="<?= base_url("exportFile/exportJsonInfo") ?>" type="button" class="btn btn-secondary" style="margin-right: 5px;">Exportar JSON</a>
                <a href="<?= base_url("exportFile/exportCsvInfo") ?>" type="button" class="btn btn-secondary">Exportar CSV</a>
            </div>
        </div>
    </div>
    <div class="div-table mt-2">
        <table class="table" id="table-items">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Marca</th>
                    <th class="text-center" scope="col">Modelo</th>
                    <th class="text-center" scope="col">Processador</th>
                    <th class="text-center" scope="col">Memória RAM</th>
                    <th class="text-center" scope="col">Armazenamento</th>
                    <th class="text-center" scope="col">Tipo de Armazenamento</th>
                    <th class="text-center" scope="col">Quantidade</th>
                    <th class="text-center" scope="col">Data do Inventário</th>
                    <th class="text-center" scope="col"> - </th>
                    <th class="text-center" scope="col"> - </th>
                </tr>
            </thead>
            <tbody id="table-body-items">
                <?php foreach ($inventorys as $inventory) : ?>
                    <tr>
                        <th scope="row"><?= $inventory->id ?></th>
                        <td class="text-center"><?= $inventory->brandName ?></td>
                        <td class="text-center"><?= $inventory->modelComputer ?></td>
                        <td class="text-center"><?= $inventory->processor ?></td>
                        <td class="text-center"><?= $inventory->ramMemory ?></td>
                        <td class="text-center"><?= $inventory->storage ?></td>
                        <td class="text-center"><?= $inventory->storageType ?></td>
                        <td class="text-center"><?= $inventory->amount ?></td>
                        <td class="text-center"><?= $inventory->dateInventory ?></td>
                        <td><div class="d-flex justify-content-center"><a href="<?= base_url("inventory/edit/{$inventory->id}") ?>" type="button" class="btn btn-info">Editar</a></div></td>
                        <td><div class="d-flex justify-content-center"><a href="<?= base_url("inventory/delete/{$inventory->id}") ?>" type="button" class="btn btn-danger btn-delete-item">Deletar</a></div></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>