.dece-header {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-bottom: 6px;
    padding-bottom: 3px;
    border-bottom: 3px solid #000;
}
.dece-header-text {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 79px;
    text-align: center;
}
.dece-header-text img {
    position: absolute;
    right: 100%;
    top: 50%;
    width: 78px;
    height: auto;
    margin-right: 10px;
    transform: translateY(-50%);
}

.dece-header-line1,
.dece-header-line2 {
    font-size: 16px;
    font-weight: bold;
    line-height: 1.1;
}

.dece-header-line3 {
    margin-top: 1px;
    font-size: 12px;
    line-height: 1.2;
}

.dece-header-line4 {
    font-size: 10.5px;
    font-weight: bold;
    line-height: 1.2;
}

#paginaPrincipal .dece-header,
#paginaSeguimiento .dece-header {
    position: absolute;
    top: 7.5mm;
    left: 8mm;
    width: calc(100% - 16mm);
    margin: 0;
}
