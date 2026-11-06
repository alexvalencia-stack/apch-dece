.dece-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    margin-bottom: 6px;
}
.dece-header::after {
    content: "";
    display: block;
    width: 148mm;
    max-width: 100%;
    margin-top: 4px;
    border-bottom: 5px solid #000;
}
.dece-header-text {
    position: relative;
    text-align: center;
}
.dece-header-text img {
    position: absolute;
    right: 100%;
    top: 50%;
    width: 55px;
    height: auto;
    margin-right: 60px;
    transform: translateY(-50%);
}
.dece-header-line1 {
    font-size: 18.67px;
    font-weight: normal;
    line-height: 1.1;
}
.dece-header-line2 {
    font-size: 21.33px;
    font-weight: normal;
    line-height: 1.1;
}
.dece-header-line3 {
    font-size: 14.67px;
    line-height: 1.1;
}
.dece-header-line4 {
    margin-top: 3px;
    font-size: 10.67px;
    font-weight: bold;
    line-height: 1.1;
}
#paginaPrincipal .dece-header,
#paginaSeguimiento .dece-header {
    position: absolute;
    top: 7.5mm;
    left: 8mm;
    width: calc(100% - 16mm);
    margin: 0;
}
