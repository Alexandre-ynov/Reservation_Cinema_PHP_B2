<?php include __DIR__ . '/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails - <?php echo htmlspecialchars($film['filmTitle'], ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .hero {
            position: relative;
            min-height: 520px;
            display: flex;
            align-items: flex-end;
            padding: 40px;
            background: linear-gradient(90deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.55) 45%, rgba(0,0,0,0.2) 100%),
                        url('/pictures/<?php echo htmlspecialchars($film['filmPoster'], ENT_QUOTES, 'UTF-8'); ?>') center/cover no-repeat;
        }

        .hero-content {
            max-width: 900px;
        }

        .hero-title {
            font-size: 44px;
            font-weight: 700;
            margin: 0 0 8px;
            letter-spacing: 0.5px;
        }

        .hero-director {
            color: #cfcfcf;
            font-size: 15px;
            margin-top: 16px;
            margin-bottom: 18px;
        }

        .hero-meta {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
            color: #ddd;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .meta-chip {
            background: rgba(255,255,255,0.08);
            padding: 6px 12px;
            border-radius: 6px;
        }


        .hero-desc {
            line-height: 1.6;
            color: #ddd;
            max-width: 800px;
        }

        .section {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px 40px;
        }

        .section-title {
            font-size: 22px;
            margin-bottom: 16px;
        }

        .sceances-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 14px;
        }

        .btn-sceance {
            background: #2a2a2a;
            padding: 16px;
            border-radius: 10px;
            text-decoration: none;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #3a3a3a;
            transition: transform 0.2s, background 0.2s;
        }

        .btn-sceance:hover {
            background: #333;
            transform: translateY(-2px);
        }

        .sceance-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sceance-date {
            font-weight: bold;
        }

        .sceance-room {
            color: #bbb;
            font-size: 13px;
        }
    </style>
</head>
<body>

<section class="hero">
    <div class="hero-content">
        <div class="hero-title">
            <?php echo htmlspecialchars($film['filmTitle'], ENT_QUOTES, 'UTF-8'); ?>
        </div>

        <div class="hero-meta">
            <?php if (!empty($film['filmTime'])): ?>
                <div class="meta-chip">⏱ <?php echo htmlspecialchars($film['filmTime'], ENT_QUOTES, 'UTF-8'); ?> min</div>
            <?php endif; ?>
            <?php if (!empty($film['filmCategory'])): ?>
                <div class="meta-chip">🎭 <?php echo htmlspecialchars($film['filmCategory'], ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>
        </div>

        <div class="hero-desc">
            <?php echo nl2br(htmlspecialchars($film['filmDetail'], ENT_QUOTES, 'UTF-8')); ?>
        </div>

        <?php if (!empty($film['filmAuthor'])): ?>
            <div class="hero-director">
                Réalisé par : <?php echo htmlspecialchars($film['filmAuthor'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section id="sceances" class="section">
    <div class="section-title">Séances disponibles</div>

    <div class="sceances-list">
        <?php if (!empty($sceances)): ?>
            <?php foreach ($sceances as $sceance): ?>
                <a href="/booking?sceanceId=<?php echo htmlspecialchars($sceance['sceanceId'], ENT_QUOTES, 'UTF-8'); ?>" class="btn-sceance">
                    <div class="sceance-info">
                        <span class="sceance-date"><?php echo htmlspecialchars($sceance['sceanceDate'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="sceance-room">Salle <?php echo htmlspecialchars($sceance['roomId'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <span>Choisir →</span>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune séance disponible pour ce film.</p>
        <?php endif; ?>
    </div>
</section>

</body>
</html>
