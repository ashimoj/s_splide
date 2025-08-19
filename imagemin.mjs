import keepfolder from "imagemin-keep-folder";
import mozjpeg from "imagemin-mozjpeg";
import pngquant from "imagemin-pngquant";
import gifsicle from "imagemin-gifsicle";
import svgo from "imagemin-svgo";
import webp from "imagemin-webp";

const THEME_NAME = process.env.npm_package_config_theme_name;
const SRC = process.env.npm_package_config_src_path;
const SRC_DIR = SRC.replace("./", "");
const DIST = process.env.npm_package_config_dist_path + "/" + THEME_NAME;
const DIST_DIR = DIST.replace("./", "");

keepfolder([SRC_DIR + "/img/**/*.{jpg,png,gif,svg}"], {
    plugins: [
        mozjpeg({
            quality: 80,
        }),
        pngquant({
            quality: [0.7, 0.8],
        }),
        gifsicle(),
        svgo(),
    ],
    replaceOutputDir: (output) => {
        return output.replace(/src\/img\//, DIST_DIR + "/img/");
    },
});

// keepfolder([SRC_DIR + "/img/**/*.{jpg,png}"], {
//     plugins: [
//         webp({
//             quality: 80,
//         }),
//     ],
//     replaceOutputDir: (output) => {
//         return output.replace(/src\/img\//, DIST_DIR + "/img/");
//     },
// });
