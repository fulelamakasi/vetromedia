<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Convert More'), ['controller' => 'Pages', 'action' => 'convertCurrency']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transactions index large-9 medium-8 columns content">
    <h3><?= __('Transactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('original_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('converted_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surge') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surge_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_to_exchangerate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($transactions)){ foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= $this->Number->format($transaction->id) ?></td>
                <td><?= $this->Number->format($transaction->original_price) ?></td>
                <td><?= $this->Number->format($transaction->converted_price) ?></td>
                <td><?= $this->Number->format($transaction->surge) ?></td>
                <td><?= $this->Number->format($transaction->surge_amount) ?></td>
                <td><?= $this->Number->format($transaction->currency_to_exchangerate) ?></td>
                <td><?= $this->Number->format($transaction->currency_from) ?></td>
                <td><?= $this->Number->format($transaction->currency_to) ?></td>
                <td><?= $transaction->has('user') ? $this->Html->link($transaction->user->username, ['controller' => 'Users', 'action' => 'view', $transaction->user->id]) : '' ?></td>
                <td><?= h($transaction->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transaction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transaction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?php echo $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]); } ?></p>
    </div>
</div>
