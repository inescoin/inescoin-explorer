<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-exchange" aria-hidden="true"></i> Transaction Information
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <td>Date</td>
                <td class="fixedfont"><?php echo date('Y-m-d H:i:s', (int)$transaction['createdAt']); ?> - <?php echo $transaction['createdAt']; ?></td>
            </tr>
            <tr>
                <td>From</td>
                <td class="fixedfont">
                    <a href="?wallet=<?php echo $transaction['fromWalletId'] ?>">
                        <?php echo $transaction['fromWalletId']; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Hash</td>
                <td class="fixedfont"><?php echo $transaction['hash']; ?></td>
            </tr>
            <tr>
                <td>Signature</td>
                <td class="fixedfont"><small><?php echo $transaction['signature']; ?></small></td>
            </tr>
            <tr>
                <td>Height</td>
                <td class="fixedfont">
                    <a href="?block-height=<?php echo $transaction['height']; ?>">
                        <?php echo $transaction['height']; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>Amount</td>
                <td class="fixedfont"><?php echo ($transaction['amount'] / 1000000000); ?></td>
            </tr>
            <tr>
                <td>Fee</td>
                <td class="fixedfont"><?php echo ($transaction['fee'] / 1000000000); ?></td>
            </tr>
            <tr>
                <td>Config Hash</td>
                <td class="fixedfont"><?php echo $transaction['configHash']; ?></td>
            </tr>
            <tr>
                <td>Coinbase</td>
                <td class="fixedfont"><?php echo !$transaction['coinbase'] ? 'false' : 'true'; ?></td>
            </tr>
            <?php if(!$transaction['coinbase']): ?>
            <tr>
                <td>Public Key</td>
                <td class="fixedfont"><?php echo $transaction['publicKey']; ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
  </div>
</div>

<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-thumb-tack" aria-hidden="true"></i> To Do's <span class="badge badge-info pull-right"><?php echo count($transaction['toDo']) ?> toDo's</span>
  </div>
  <div class="card-body">
    <?php
        $i = 1;
        if (isset($transaction['toDo'])) {
    ?>
    <?php foreach ($transaction['toDo'] as $toDo): ?>
        <h2 class="badge badge-info">To Do: <?php echo $i; ?></h2>
        <p>
            <b>Hash:</b>
            <?php echo $toDo['hash']; ?>
        </p>
        <p>
            <b>Action:</b>
            <?php echo $toDo['action']; ?>
        </p>
        <p>
            <b>Name:</b>
            <a href="?domain=<?php echo $toDo['name']; ?>"><?php echo $toDo['name']; ?></a>
        </p>
        <?php if ($toDo['action'] === 'update') { ?>
        <p>
            <b>Command:</b>
            <?php echo base64_encode(json_encode($toDo['data'])); ?>
        </p>
        <?php } ?>
        <p>
            <b>Signature:</b>
            <?php echo $toDo['signature']; ?>
        </p>
        <hr />
    <?php
        $i++;
    ?>
    <?php endforeach; ?>
    <?php
        }
    ?>
  </div>
</div>

<div class="card mt-4">
  <div class="card-header">
    <i class="fa fa-thumb-tack" aria-hidden="true"></i> Transfers <span class="badge badge-info pull-right"><?php echo count($transaction['transfers']) ?> transfers</span>
  </div>
  <div class="card-body">
    <table class="table table-responsive table-striped w-100">
        <tbody>
            <tr>
                <th>To</th>
                <th>Amount</th>
                <th>Hash</th>
                <th>Wallet ID</th>
                <th>Nonce</th>
            </tr>
            <?php foreach ($transaction['transfers'] as $transfer): ?>
            <tr>
                <td class="align-center">
                    <a href="?wallet=<?php echo $transfer['toWalletId']; ?>">
                        <?php echo $transfer['toWalletId']; ?>
                    </a>
                </td>
                <td class="align-center"><?php echo ($transfer['amount'] / 1000000000); ?></td>
                <td class="align-center" title="<?php echo $transfer['hash']; ?>">
                    <a href="?transfer=<?php echo $transfer['hash']; ?>">
                        <div class="truncate"><?php echo $transfer['hash']; ?></div>
                    </a>
                </td>
                <td class="align-center"><?php echo $transfer['walletId']; ?></td>
                <td class="align-center" title="<?php echo $transfer['nonce']; ?>"><div class="truncate"><?php echo $transfer['nonce']; ?></div></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>

