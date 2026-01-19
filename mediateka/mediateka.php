<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediateka - Gimnasio Denda</title>
    <link rel="icon" href="../img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/oinarria.css">
    <link rel="stylesheet" href="../css/mediateka.css">
    <link rel="stylesheet" href="../css/mediateka-video.css">
    <link rel="stylesheet" href="../css/erantzunkorra.css">
    <script src="media.js" defer></script>
</head>
<body>
    <div class="container">
        <header style="position: relative;">
            <div class="logo-link">
                <img src="../img/logo.jpg" alt="logoa">
                <h1 class="logo">GimFit Store®</h1>
            </div>
            <a href="../saskia/index.php" class="nav-btn" style="position: absolute; top: 40px; right: 40px;">🛒 Saskia</a>
            <p class="subtitle">Zure gimnasioko ekipo ezin hobea aurkitu!</p>
            <div class="nav-links">
                <a href="../hasiera/index.php" class="nav-btn">🏠 Hasiera</a>
                <a href="../admin/index.php" class="nav-btn admin">⚙️ Admin Gunea</a>
                <a href="../katalogoa/index.php" class="nav-btn">📂 Katalogoa</a>
                <a href="../kontaktua/index.php" class="nav-btn">✉️ Kontaktua</a>
                <a href="../mediateka/index.php" class="nav-btn">🖼️ Mediateka</a>
            </div>
        </header>

        <div class="page-header">
            <h1>🖼️ Mediateka</h1>
            <p>Hemen gure multimedia baliabideen bilduma aurkituko duzu.</p>
            </div>
            <main class="mediateka-content">
            <!-- IRUDIAK -->
            <section class="media-section">
                <h2>Irudiak</h2>
                
                <div class="media-group">
                    <h3>Figure eta Figcaption</h3>
                    <figure class="adibidea-figure">
                        <img src="../img/logo.jpg" alt="GimFit Logo" style="max-width: 200px;">
                        <figcaption>GimFit Store-ren logo ofiziala.</figcaption>
                    </figure>
                </div>

                <div class="media-group">
                    <h3>Galeria</h3>
                    <div class="gallery-container">
                        <button class="gallery-btn prev" onclick="moveGallery(-1)">&#10094;</button>
                        <div class="gallery-window">
                            <div class="gallery-track">
                                <?php foreach ($produktuak as $produktua): 
                                    $imagePathJpg = "../img/produktuak/" . $produktua->getId() . ".jpg";
                                    $imagePathPng = "../img/produktuak/" . $produktua->getId() . ".png";
                                    $imagePath = file_exists($imagePathJpg) ? $imagePathJpg : (file_exists($imagePathPng) ? $imagePathPng : null);
                                    
                                    if ($imagePath):
                                ?>
                                    <div class="gallery-item">
                                        <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($produktua->getIzena()); ?>">
                                        <p><?php echo htmlspecialchars($produktua->getIzena()); ?></p>
                                    </div>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>
                        <button class="gallery-btn next" onclick="moveGallery(1)">&#10095;</button>
                    </div>
                </div>

                <div class="media-group">
                    <h3>Sprites</h3>
                    <p>Irudi bakarra kargatzen da, baina zati desberdinak erakusten dira:</p>
                    <div class="sprite-container">
                        <!-- Elementu hauek irudi bera erabiltzen dute atzealde gisa -->
                        <div class="icon-sprite icon-1" title="Zatia 1"></div>
                        <div class="icon-sprite icon-2" title="Zatia 2"></div>
                        <div class="icon-sprite icon-3" title="Zatia 3"></div>
                    </div>
                </div>
            </section>

            <!-- AUDIOA -->
            <section class="media-section">
                <h2>Audioa</h2>
                
                <div class="media-group">
                    <h3>Entrenamendu Audioak</h3>
                    <div class="video-container">
                        <div class="main-video">
                            <audio id="mainAudio" controls style="width: 100%; margin-top: 20px;">
                                <source src="audio/lightweight.m4a" type="audio/mp4">
                                Zure nabigatzaileak ez du audio elementua onartzen.
                            </audio>
                        </div>
                        <div class="video-playlist">
                            <h4>Aukeratu audioa:</h4>
                            <div class="playlist-items">
                                <button onclick="changeAudio('../audio/lightweight.m4a')" class="playlist-btn">🎵 Lightweight</button>
                                <button onclick="changeAudio('../audio/musicagym.m4a')" class="playlist-btn">🎵 Gym Music</button>
                                <button onclick="changeAudio('../audio/musicgym.m4a')" class="playlist-btn">🎵 Music Gym</button>
                                <button onclick="changeAudio('../audio/gymusic.mp3')" class="playlist-btn">🎵 Gymusic</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="media-group">
                    <h3>Audio Kontrolak</h3>
                    <div class="controls">
                        <button onclick="playAudio()" class="btn">Play</button>
                        <button onclick="pauseAudio()" class="btn">Pause</button>
                        <button onclick="volumeDownAudio()" class="btn">Bolumena -</button>
                        <button onclick="volumeUpAudio()" class="btn">Bolumena +</button>
                        <button onclick="rewindAudio()" class="btn">Aurreko Audioa</button>
                        <button onclick="advanceAudio()" class="btn">Hurrengo Audioa</button>
                    </div>
                </div>
            </section>

            <!-- BIDEOA -->
            <section class="media-section">
                <h2>Bideoa</h2>

                <div class="media-group">
                    <h3>Entrenamendu Bideoak</h3>
                    <div class="video-container">
                        <div class="main-video">
                            <video id="bideoa" width="100%" controls>
                                <source src="../video/biceps.mp4" type="video/mp4">
                                Zure nabigatzaileak ez du bideo elementua onartzen.
                            </video>
                        </div>
                        <div class="video-playlist">
                            <h4>Aukeratu bideoa:</h4>
                            <div class="playlist-items">
                                <button onclick="changeVideo('../video/biceps.mp4')" class="playlist-btn">💪 Besoak</button>
                                <button onclick="changeVideo('../video/espalda.mp4')" class="playlist-btn">🔙 Bizkarra</button>
                                <button onclick="changeVideo('../video/gluteo.mp4')" class="playlist-btn">🍑 Ipurdia</button>
                                <button onclick="changeVideo('../video/pecho.mp4')" class="playlist-btn">👕 Bularra</button>
                                <button onclick="changeVideo('../video/pierna.mp4')" class="playlist-btn">🦵 Hanka</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="media-group">
                    <h3>JavaScript Bideo Kontrolak</h3>
                    <div class="controls">
                        <button onclick="playVideo()" class="btn">Play</button>
                        <button onclick="pauseVideo()" class="btn">Pause</button>
                        <button onclick="muteVideo()" class="btn">Mute/Unmute</button>
                        <button onclick="volumeUpVideo()" class="btn">Bolumena +</button>
                        <button onclick="volumeDownVideo()" class="btn">Bolumena -</button>
                        <button onclick="advanceVideo()" class="btn">Siguiente Video</button>
                        <button onclick="rewindVideo()" class="btn">Anterior Video</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
